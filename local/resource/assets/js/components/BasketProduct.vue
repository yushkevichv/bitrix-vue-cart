<template>
    <div class="row">
        <div class="col-md-4">
            <div class="photo_container">
                <a :href="product.DETAIL_PAGE_URL">
                    <div class="ordercart_photo" :style="{ 'background-image': 'url('+ pictureSrc + ')' }"></div>
                </a>
            </div>
            <span >
                <a :href="product.DETAIL_PAGE_URL">
                    {{ product.NAME }}
                </a>
            </span>
        </div>
        <div class="col-md-1">
            {{ product.DISCOUNT_PRICE_PERCENT }} %
        </div>
        <div class="col-md-2">
            {{ product.PRICE }} руб.
        </div>

        <div class="col-md-1 ">
            <input type="number"  v-model="quantity" style="width:60px;"
                @change="updateQuantity"
            >

        </div>
        <div class="col-md-2">
            {{ summ }}  руб.
        </div>

        <div class="col-md-2">
            <span @click="deleteItem">Удалить</span>
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
              quantity: this.product.QUANTITY,
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
            },
            summ: function () {
                return this.product.PRICE * this.quantity;
            }
        },
        methods: {
            updateQuantity()  {

                let data = {
                    sessid: this.sessid,
                    product_id: this.product.ID,
                    product: this.product.PRODUCT_ID,
                    quantity: this.quantity,
                }

                axios.post("/local/api/cart.php", data)
                    .then(response => {
                        this.$emit('dataUpdated', response.data);

                    })
                .catch(error => console.error(error));

            },
            deleteItem() {
                
                axios.get("/local/api/cart.php?action=delete&id="+this.product.ID)
                    .then(response => {
                        this.$emit('remove', response.data);
                    })
                    .catch(error => console.error(error));
            }
        }
    }
</script>

<style scoped>
    .photo_container, .ordercart_photo {
        width: 150px;
        height: 150px;
        padding-top: 0px;
    }

    .ordercart_photo {
        background-position: center;
        -webkit-background-size: auto 100%;
        background-size: auto 100%;
        background-repeat: no-repeat;
    }

</style>
