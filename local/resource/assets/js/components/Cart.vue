<template>
    <div class="container">
        <div id="basket_form_container">
            <div class="bx_ordercart bx_green">
                <div class="bx_sort_container">
                    <span>Товары в корзине:</span>
                </div>
                <div v-if="products">
                    <div id="basket_items_list">
                        <div class="bx_ordercart_order_table_container">
                            <div id="basket_items">
                                <div class="row">
                                    <div class="col-md-4">
                                        Товары
                                    </div>
                                    <div class="col-md-1">
                                        Скидка
                                    </div>
                                    <div class="col-md-2">
                                        Цена
                                    </div>
                                    <div class="col-md-1">
                                        Количество
                                    </div>
                                    <div class="col-md-2">
                                        Сумма
                                    </div>
                                    <div class="col-md-2"></div>


                                </div>
                                <div v-for="(product, index) in products" :key="product.ID">
                                    <basket-product :product="product"
                                        @dataUpdated="updateCart"
                                        @remove="(value) => removeProduct(index, value)"
                                    >
                                    </basket-product>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8" style="text-align: right;">
                            <span>Товаров на:	{{ allSum }} руб</span> <br />
                            <span style="text-decoration: line-through;">{{ allBaseSum }} руб.</span> <br />
                            <span style="font-weight: bold;">Итого:	{{ allSum }} руб.</span> <br />
                        </div>

                    </div>

                    <div class="row checkout__block">
                        <div class="col-md-2 col-md-offset-10" >
                            <button @click="submit" class="checkout__link">Оформить заказ</button>
                        </div>
                    </div>
                </div>
                <div v-else>
                    В корзине нет товаров
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
//            console.log('Component mounted.')
        },
        computed: {

        },

        props: {
            arrProducts: {
                type: Array,
                required: false
            },
            totalBasketPrice: {
                type: [String, Number],
                required: true
            },
            totalBasketBasePrice: {
                type: [String, Number],
                required: true
            }
        },
        data: function() {
            return {
                allBaseSum: this.totalBasketBasePrice,
                allSum: this.totalBasketPrice,
                products: this.arrProducts,
            }
        },
        methods: {
            updateCart(value) {
                this.allBaseSum = value.totalBasketBasePrice;
                this.allSum = value.totalBasketPrice;
            },
            removeProduct(index, value) {
                this.products.splice(index, 1);
                this.allBaseSum = value.totalBasketBasePrice;
                this.allSum = value.totalBasketPrice;
            },
            submit() {
                window.location.href='/personal/order/make/';
            }
        },
        components: {
            "basket-product": require("./BasketProduct.vue")
        }

    }
</script>

<style scoped>
    .checkout__block {
        margin-top: 30px;
        margin-bottom: 30px;
    }
    .checkout__link {
        background: linear-gradient(to bottom,#99d23e 0,#63aa28 100%);
        color: #fff;
        text-shadow: 0 1px 0 #0075b6;
        padding: 15px;
    }

</style>
