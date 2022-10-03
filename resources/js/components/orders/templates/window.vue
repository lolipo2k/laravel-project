<template>
    <div class="window">
        <div class="common__title">Wybierz odpowiednią ilość okien</div>

        <div class="window__img">
            <img src="/images/window/01.jpg" alt="Photo">
        </div>

        <div class="clean__forms-item common__forms-item window">
            <div class="clean__minus" id="minus__wind" @click="takeWindow">-</div>
            <div class="clean__text">
                <span id="num__wind">{{ count }}</span>
                <span id="wind">okien</span>
            </div>
            <div class="clean__plus" id="plus__wind" @click="addWindow">+</div>
        </div>

        <div class="price__window">
            <p class="_icon-33">Koszt mycia jednego okna <span>{{ windowPrice.toFixed(2) }} zł</span></p>
        </div>

        <div class="common-count _spollers">
            <div class="common__tab-item">
                <div class="common__tabs-title _spoller _init">
                    <p>Jak liczymy ilość okien</p>
                </div>
                <div class="common__tabs-list" style="display: none;">
                    <div class="common-tab">
                        <div class="common__tabs-item">
                            <div class="common-tabs__img">
                                <img src="/images/window/02.jpg" alt="">
                            </div>
                            <div class="common-tabs__text">
                                jedno okno
                            </div>
                        </div>
                        <div class="common__tabs-item">
                            <div class="common-tabs__img">
                                <img src="/images/window/03.jpg" alt="">
                            </div>
                            <div class="common-tabs__text">
                                pół okna
                            </div>
                        </div>
                        <div class="common__tabs-item">
                            <div class="common-tabs__img">
                                <img src="/images/window/04.jpg" alt="">
                            </div>
                            <div class="common-tabs__text">
                                1,5 okna
                            </div>
                        </div>
                        <div class="common__tabs-item">
                            <div class="common-tabs__img">
                                <img src="/images/window/05.jpg" alt="">
                            </div>
                            <div class="common-tabs__text">
                                2 okna
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "window",
    props: {
        windowPrice: Number,
        windowMin: Number,
    },
    data() {
        return {
            count: this.windowMin,
            price: 0
        }
    },
    mounted() {
        this.price = this.windowMin * this.windowPrice
        this.$emit('changePrice', this.price)
    },
    methods: {
        addWindow()
        {
            this.count++
            this.price += this.windowPrice
            this.$emit('changePrice', this.price)
        },
        takeWindow()
        {
            if (this.count > this.windowMin)
            {
                this.count--
                this.price -= this.windowPrice
                this.$emit('changePrice', this.price)
            }
        }
    }
}
</script>

<style scoped>

</style>
