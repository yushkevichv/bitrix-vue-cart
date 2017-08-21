<template>
    <div >
        <div class="bx_ordercart_photo_container photo_container">
            <a :href="product.DETAIL_PAGE_URL">
                <div class="bx_ordercart_photo" :style= "{ 'background-image': 'url('+ pictureSrc + ')' }"></div>
            </a>
        </div>
        <h2 class="bx_ordercart_itemtitle">
             <a :href="product.DETAIL_PAGE_URL">
                 {{ product.NAME }}
            </a>
        </h2>


    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        computed: {
            pictureSrc: function() {
                if(this.product.PREVIEW_PICTURE_SRC.length >0 )
                    return this.product.PREVIEW_PICTURE_SRC;
                if(this.product.DETAIL_PICTURE_SRC.length >0 )
                    return this.product.DETAIL_PICTURE_SRC;
                else
                    return '/local/templates/.default/components/bitrix/sale.basket.basket.ajax/images/no_photo.png';
            }
        }
    }
</script>

<style scoped>
    .photo_container, .bx_ordercart_photo {
        width: 150px;
        height: 150px;
    }
</style>
