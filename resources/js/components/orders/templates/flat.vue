<template>
    <div class="common__options" id="result-common">
        <div class="common__title">Twoje mieszkanie</div>
        <div class="clean__forms-list">

            <div class="clean__forms-item common__forms-item">
                <div class="clean__minus" id="minus__room" @click="takeRooms">-</div>
                <div class="clean__text" id="room-common">
                    <span id="num__room">{{ counterRooms }}</span>
                    <span id="room">pokój</span>
                    <input type="hidden" value="1" id="input__rooms" name="rooms">
                </div>
                <div class="clean__plus" id="plus__room" @click="addRooms">+</div>
            </div>

            <div class="clean__forms-item common__forms-item">
                <div class="clean__minus" id="minus__bath" @click="takeBath">-</div>
                <div class="clean__text" id="bath-common">
                    <span id="num__bath">{{ counterBath }}</span>
                    <span id="bath">łazienka</span>
                    <input type="hidden" value="1" id="input__bath" name="bathrooms">
                </div>
                <div class="clean__plus" id="plus__bath" @click="addBath">+</div>
            </div>

        </div>
        <div class="common__house _frequency" v-bind:class="{ _active: private }">
            <label for="house-1" id="house-price" @click="changePrivate"></label>
            <input type="checkbox" class="service" id="house-1" name="private_house" value="1">
            <p class="_icon-31">Dom prywatny <span>x{{ privateMulti }}</span></p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Flat",
    props: {
        priceRooms: Number,
        priceBath: Number,
        privateMulti: Number,
    },
    data() {
        return {
            price: 0,
            counterRooms: 1,
            counterBath: 1,
            private: false,
        }
    },
    mounted() {
        this.calc()
    },
    methods: {
        addRooms()
        {
            this.counterRooms++
            this.calc()
        },
        takeRooms()
        {
            if (this.counterRooms > 1)
            {
                this.counterRooms--
                this.calc()
            }
        },
        addBath()
        {
            this.counterBath++
            this.calc()
        },
        takeBath()
        {
            if (this.counterBath > 1)
            {
                this.counterBath--
                this.calc()
            }
        },
        changePrivate()
        {
            this.private = !this.private
            this.calc()
        },
        calc()
        {
            let price = 0

            price += this.priceRooms * this.counterRooms
            price += this.priceBath * this.counterBath

            if (this.private)
            {
                price = price * this.privateMulti
            }

            this.price = price

            let params = {
                rooms: this.counterRooms,
                bath: this.counterBath,
                private: this.private,
                price: this.price
            }

            this.$emit('changePrice', params)
        }
    }
}
</script>

<style scoped>

</style>
