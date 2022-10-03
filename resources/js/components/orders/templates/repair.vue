<template>
    <div class="common__options">
        <div class="common__title">Mieszkanie po remoncie</div>
        <div class="clean__forms-list">
            <div class="clean__forms-item common__forms-item">
                <div class="clean__minus" id="minus__bath" @click="takeMeters">-</div>
                <div class="clean__text" id="bath-common">
                    <span id="num__bath">{{ counterMeters }}</span>
                    <span id="bath">m²</span>
                </div>
                <div class="clean__plus" id="plus__bath" @click="addMeters">+</div>
            </div>

            <div class="clean__forms-item common__forms-item">
                <div class="clean__minus" @click="takeWindows">-</div>
                <div class="clean__text">
                    <span>{{ counterWindows }}</span>
                    <span>okien</span>
                </div>
                <div class="clean__plus"  @click="addWindows">+</div>
            </div>
        </div>

        <div class="common__house" :class="{ _active: isStairs }">
            <label for="stair" id="stairs" @click="changeStairs"></label>
            <input type="checkbox" class="service" id="stair" name="repair_stairs">
            <p class="_icon-32">Potrzebna drabina<span>{{ stairs.toFixed(2) }} </span><span>zł</span></p>
        </div>
    </div>
</template>

<script>
export default {
    name: "repair",
    props: {
        stairs: Number,
        priceMeter: Number,
        priceWindow: Number,
    },
    data() {
        return {
            price: 0,
            counterMeters: 1,
            counterWindows: 1,
            isStairs: false
        }
    },
    mounted() {
        this.calc()
    },
    methods: {
        addMeters()
        {
            this.counterMeters++
            this.calc()
        },
        takeMeters()
        {
            if (this.counterMeters > 1)
            {
                this.counterMeters--
                this.calc()
            }
        },
        addWindows()
        {
            this.counterWindows++
            this.calc()
        },
        takeWindows()
        {
            if (this.counterWindows > 1)
            {
                this.counterWindows--
                this.calc()
            }
        },
        changeStairs()
        {
            this.isStairs = !this.isStairs
            this.calc()
        },
        calc()
        {
            let price = 0

            price += this.counterWindows * this.priceWindow
            price += this.counterMeters * this.priceMeter

            if (this.isStairs)
            {
                price += this.stairs
            }

            this.price = price

            let params = {
                meters: this.counterMeters,
                window: this.counterWindows,
                stairs: this.stairs,
                price: this.price
            }

            this.$emit('changePrice', params)
        }
    }
}
</script>

<style scoped>

</style>
