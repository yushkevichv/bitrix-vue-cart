<template>
    <div id="basket_items_list">
        <div class="bx_ordercart_order_table_container">
            <div id="basket_items">
                <div class="row">
                    <div class="col-md-4" >
                        Товары
                    </div>
                    <div class="col-md-2">
                        Цена
                    </div>
                    <div class="col-md-2">
                        Количество
                    </div>
                    <div class="col-md-2">
                        Сумма
                    </div>
                    <div class="col-md-2"></div>


                </div>

                <basket-product></basket-product>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
//            console.log('Component mounted.')
        },
        props: {
            products: {
                type: Array,
                required: false
            }
        },
//        data: function () {
//            return {
//                products: []
//            }
//        },
        components: {
            "basket-product": require("./BasketProduct.vue")
        }
    }
</script>
