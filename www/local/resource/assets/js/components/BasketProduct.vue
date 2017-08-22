<template>
    <div class="row">
        <div class="bx_ordercart_photo_container photo_container col-md-4">
            <a :href="product.DETAIL_PAGE_URL">
                <div class="bx_ordercart_photo" :style="{ 'background-image': 'url('+ pictureSrc + ')' }"></div>
            </a>
        </div>
        <h2 class="bx_ordercart_itemtitle col-md-2">
            <a :href="product.DETAIL_PAGE_URL">
                {{ product.NAME }}
            </a>
        </h2>

        <div class="col-md-1">
            <input type="number"  v-model="quantity"
            @change="updateQuantity"
            >
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
//            this.count = 5;
//            console.log('Component mounted.')
        },
        data: function() {
          return {
              quantity: this.product.QUANTITY
          }

        },
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        computed: {
            pictureSrc: function () {
                if (this.product.PREVIEW_PICTURE_SRC.length > 0)
                    return this.product.PREVIEW_PICTURE_SRC;
                if (this.product.DETAIL_PICTURE_SRC.length > 0)
                    return this.product.DETAIL_PICTURE_SRC;
                else
                    return '/local/templates/.default/components/bitrix/sale.basket.basket.ajax/images/no_photo.png';
            }
        },
        methods: {
            updateQuantity()  {
                console.log('id '+this.product.ID);
                console.log('this ' + this.quantity);

                let data = {
                    sessid: this.sessid,
                    product_id: this.product.ID,
                    product: this.product.PRODUCT_ID,
                    quantity: this.quantity,
                }

                //data['QUANTITY_' + this.product.ID] = this.quantity;

//                axios.post("/bitrix/components/bitrix/sale.basket.basket/ajax.php", data)
                axios.post("/local/api/cart.php", data)
                    .then(response => {
                        console.log(response);
                    })
                .catch(error => console.error(error));

            }
        }
    }
</script>

<style scoped>
    .photo_container, .bx_ordercart_photo {
        width: 150px;
        height: 150px;
    }
    .bx_ordercart .bx_ordercart_photo_container {
        padding-top: 0px;
    }
</style>
