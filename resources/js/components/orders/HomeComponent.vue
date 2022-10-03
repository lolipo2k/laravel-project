<template>
    <div>
        <div v-show="step === 1" class="common _container">
            <div class="common__left">
                <Additionals
                    :list="furnituresList"
                    :type="1"

                    @changePrice="changePriceFurniture"
                />

                <Window
                    v-show="service['window']"
                    :windowPrice="service['window_price']"
                    :windowMin="service['window_min']"

                    @changePrice="changePriceWindow"
                />

                <Flat
                    v-show="service['apartment']"
                    :priceRooms="service['rooms_price']"
                    :priceBath="service['bathrooms_price']"
                    :privateMulti="service['private_house']"

                    @changePrice="changePriceFlat"
                />

                <Repair
                    v-show="service['repairs']"
                    :stairs="service['repair_stairs_price']"
                    :priceMeter="service['repair_price']"
                    :priceWindow="service['repair_window_price']"

                    @changePrice="changePriceRepairs"
                />

                <Additionals
                    :list="additionalsList"
                    :type="2"

                    @changePrice="changePriceAdditionals"
                />

                <Date
                    @changeTime="changeDate"
                />

            </div>

            <div class="common__right">
                <div class="common__subtitle">
                    Nasi pracownicy posiadają wszystkie niezbędne środki czystości, narzędzia oraz odkurzacz
                </div>
                <div class="common__form-pay">
                    <div class="common__price" id="time-repair-common">
                        Przybliżony czas sprzątania <span>~ </span><span id="time-repair">{{ time }}</span>
                        <span>godz.</span>
                    </div>
                    <div class="common__price">
                        Minimalny koszt zamówienia 100.00 zł
                    </div>
                    <div class="promocode__wrap">
                        <span> Kod rabatowy</span>
                        <div class="promocode">
                            <input type="text" placeholder="Wpisz kod rabatowy" id="promocode__inp" name="promocode">
                            <button type="button" @click="getPromocode" id="promocode__btn" :class="{ active: promocode.use}">{{ promocode.use ? 'Usuń':'Zastosuj' }}</button>
                        </div>
                    </div>
                    <div class="common__pay">
                        <div class="pay__price-text">
                            Do zapłaty:
                        </div>
                        <div class="pay__price-number">
                            <div class="last-result" :class="{ active: promocode.use }">
                                <span class="last-result-span">{{ (price + this.promocode.percent).toFixed(2) }}</span> zł
                            </div>
                            <div class="last-result"><span class="last-result-span"></span>zł</div>
                            <span id="result" data-start="0">{{ price.toFixed(2) }}</span> <span>zł</span>
                        </div>
                    </div>
                    <div class="common__pay _mobile">
                        <div class="pay__price-text">
                            Do zapłaty:
                        </div>
                        <div class="pay__price-number">
                            <span id="result-mobile">{{ price.toFixed(2) }}</span><span>zł</span>
                        </div>
                    </div>
                    <div class="_container">
                        <div class="pay__btn _btn" style="display: block;">
                            <button type="button" @click="step = 2" id="btn-order">Zamów</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-show="step === 2" id="stepDuo" class="buy _container">
            <div class="buy__title" v-show="auth">
                Wybierz jeden z zapisanych adresów
            </div>
            <div class="buy__adres" v-show="auth">
                <div class="adres__item" v-for="item in addresslist" :class="{ _active: address.id === item.id }">
                    <label class="city" @click="changeAddress(item)"></label>
                    <p class="_icon-14">ul. {{ item.street }}, dom. {{ item.house_number}}, kw. {{ item.apartment_number }}</p>
                </div>
            </div>
            <div class="buy__title">Lub wprowadź swój adres</div>
            <div class="buy__text">Wybierz jedną z opcji jeśli klucze trzeba odebrać z pod innego adresu, lub dostarczyć je po sprzątaniu</div>
            <div class="my__adres">
                <div class="adres__item dostawa" :class="{ '_active-1': deliveryKey === 1}">
                    <label class="_key" @click="changeDeliveryKeys(1)"></label>
                    W jedną stronę<span>{{ keyOne.toFixed(2) }} zł</span>
                </div>

                <div class="adres__item dostawa" :class="{ '_active-1': deliveryKey === 2}">
                    <label class="_key" @click="changeDeliveryKeys(2)"></label>
                    W dwie strony<span>{{ keyDuo.toFixed(2) }} zł</span>
                </div>

                <div class="adres__key">
                    <p class="_icon-19">Dostawa kluczy</p>
                </div>
            </div>

            <label class="label__form">Adres</label>
            <div class="input__row-1">
                <input autocomplete="off" type="text" :class="{ _error: $v.address.street.$error }" v-model="address.street" placeholder="Ulica" class="_req order__input input">
                <input autocomplete="off" type="text" :class="{ _error: $v.address.house.$error }" v-model="address.house" placeholder="Numer domu" class="order__input input">
                <input autocomplete="off" type="text" :class="{ _error: $v.address.apartament.$error }" v-model="address.apartament" placeholder="Numer mieszkania" class="order__input input">
            </div>
            <div class="input-row-2">
                <input autocomplete="off" type="text" :class="{ _error: $v.address.entrance.$error }" v-model="address.entrance" placeholder="Numer klatki" class="order__input input">
                <input autocomplete="off" type="text" :class="{ _error: $v.address.floor.$error }" v-model="address.floor" placeholder="Piętro" class="order__input input">
                <input autocomplete="off" type="text" :class="{ _error: $v.address.intercom.$error }" v-model="address.intercom" placeholder="Kod od domofonu" class="order__input input">
            </div>
            <label class="label__form">Dane kontaktowe</label>
            <div class="input-row-3">
                <input autocomplete="off" type="text" data-error="Ошибка" :class="{ _error: $v.name.$error }" v-model="name" placeholder="Imię" class=" order__input input">
                <input autocomplete="off" type="text" data-error="Ошибка" :class="{ _error: $v.phone.$error }" v-model="phone" placeholder="Telefon kontaktowy" class="order__input input">
                <input autocomplete="off" type="email" data-error="Ошибка" :class="{ _error: $v.email.$error }" v-model="email" placeholder="Adres e-mail" class="order__input input">
            </div>
            <div class="txt-area">
                <textarea cols="30" rows="10" v-model="information" placeholder="Dodatkowa informacja do zamówienia"></textarea>
            </div>
            <div class="buy__title">Wybierz metodę płatności</div>
            <div class="pay__item-list">
                <div class="pay__item" :class="{ '_active-2': systemPay === 1, 'is-invalid': $v.systemPay.$error }">
                    <label for="cash-1" class="pay-label" @click="changePaymentsMethods(1)"></label>
                    <input type="checkbox" class="service" id="cash-1">
                    <p class="_icon-20">Gotówką</p>
                </div>

                <div class="pay__item" :class="{ '_active-2': systemPay === 2, 'is-invalid': $v.systemPay.$error }">
                    <label for="cash-2" class="pay-label" @click="changePaymentsMethods(2)"></label>
                    <input type="checkbox" class="service" id="cash-2">
                    <p class="_icon-21">Kartą online</p>
                </div>
            </div>
            <div class="pay__check-list">
                <div class="pay__check">
                    <label class="checkbox" for="isRules" :class="{ _error: $v.rules.$error}">
                        <input class="checkbox__input" id="isRules" type="checkbox" v-model="rules">
                        <span class="checkbox__text"><span>Składając zamówienie zgadzam się z <a href="/docs/Regulamin.pdf" target="_blank" class="link">Regulaminem</a> i <a href="/docs/Polityka-prywatnosci.pdf" target="_blank" class="link">Polityką prywatności</a></span></span>
                    </label>
                </div>
                <div class="pay__check">
                    <label class="checkbox" for="isData" :class="{ _error: $v.data.$error }">
                        <input class="checkbox__input" id="isData" type="checkbox" v-model="data">
                        <span class="checkbox__text"><span>Wyrażam zgodę na przetwarzanie moich danych osobowych przez administratora w celach marketingowych</span></span>
                    </label>
                </div>
            </div>
            <div class="pay__btn">
                <button type="button" @click="createOrder" id="buyButton">Zamów za {{ price.toFixed(2) }} zł</button>
            </div>
        </div>
    </div>
</template>

<script>
import Flat from './templates/flat'
import Window from './templates/window'
import Repair from './templates/repair'
import Additionals from './templates/additionals'
import Date from "./templates/date";
import { email, required, minValue } from 'vuelidate/lib/validators'

export default {
    props: [
        'service',
        'auth',
        'userid',
        'addresslist',
        'username',
        'userphone',
        'useremail'
    ],
    components: {
        Flat,
        Window,
        Repair,
        Additionals,
        Date
    },
    data() {
        return {
            step: 1,
            price: 0,
            time: 0,
            date: null,
            window: {
                price: 0,
                time: 0,
                count: 0
            },
            flat: {
                price: 0,
                rooms: 0,
                roomsTime: 0,
                bath: 0,
                bathTime: 0,
                private: 0,
            },
            repairs: {
                price: 0,
                meters: 0,
                window: 0,
                stairs: false,
            },
            additionals: {
                price: 0,
                selected: null,
                count: null,
            },
            furnitures: {
                price: 0,
                selected: null,
                count: null,
            },
            promocode: {
                use: false,
                code: null,
                percent: 0,
            },
            additionalsList: [],
            furnituresList: [],
            systemPay: 0,
            deliveryKey: 0,
            keyOne: 15,
            keyDuo: 30,
            selectedAddress: 0,
            name: null,
            phone: null,
            email: null,
            information: '',
            rules: false,
            data: false,
            address: {
                id: null,
                street: '',
                house: '',
                apartament: '',
                entrance: '',
                floor: '',
                intercom: ''
            }
        }
    },
    mounted() {
        axios.get('/api/service/get/additionals', {
            params: {
                'id': this.service.id
            }
        }).then(response => {
            if (response.data.data)
            {
                this.additionalsList = response.data.data
            }
        }).catch(function (error) {
            console.log(error);
        })

        axios.get('/api/service/get/furniture', {
            params: {
                'id': this.service.id
            }
        }).then(response => {
            if (response.data.data)
            {
                this.furnituresList = response.data.data
            }
        }).catch(function (error) {
            console.log(error);
        })

        this.time = this.service['minutes']

        this.name = this.username
        this.email = this.useremail
        this.phone = this.userphone
    },
    validations: {
        name: {required},
        email: {email, required},
        phone: {required},
        rules: { checked: value => value === true },
        data: { checked: value => value === true },
        systemPay: { minValue: minValue(1) },
        address: {
            street: { required },
            house: { required },
            apartament: { required },
            entrance: { required },
            floor: { required },
            intercom: { required }
        }
    },
    methods: {
        changePriceWindow(winPrice) {
            this.window.price = winPrice
            let countWindow = winPrice / this.service['window_price']
            this.window.count = countWindow
            this.window.time = countWindow * this.service['window_time']
            this.calc()
        },
        changePriceFlat(params) {
            this.flat.rooms = params.rooms
            this.flat.roomsTime = params.rooms * this.service['rooms_time']

            this.flat.bath = params.bath
            this.flat.bathTime = params.bath * this.service['bathrooms_time']

            this.flat.private = params.private
            this.flat.price = params.price

            this.calc()
        },
        changePriceRepairs(params) {
            this.repairs.price = params.price
            this.repairs.meters = params.meters
            this.repairs.window = params.window
            this.repairs.stairs = params.stairs

            this.calc()
        },
        changePriceAdditionals(params) {
            this.additionals.price = params.price
            this.additionals.selected = params.selected
            this.additionals.count = params.selectedCount

            this.calc()
        },
        changePriceFurniture(params) {
            this.furnitures.price = params.price
            this.furnitures.selected = params.selected
            this.furnitures.count = params.selectedCount

            this.calc()
        },
        changeDate(date) {
            this.date = date
        },
        getPromocode() {
            const promocode = document.getElementById('promocode__inp').value
            if (promocode.length) {
                if (!this.promocode.use) {
                    axios.get('/api/promocode/check', {
                        params: {
                            'name': promocode
                        }
                    }).then(response => {
                        if (response.data.data.status && !this.promocode.use) {
                            this.promocode.use = true
                            this.promocode.code = response.data.data.name
                            this.promocode.percent = response.data.data.percent
                        }
                    }).catch(function (error) {
                        console.log(error);
                    })
                } else {
                    this.promocode.use = false
                    this.promocode.code = null
                    this.promocode.percent = 0
                }
                this.calc()
            }
        },
        calc() {
            let price = 0;
            let time = 0

            if (this.service['window']) {
                price += this.window.price
                time += this.window.time
            }

            if (this.service['apartment']) {
                price += this.flat.price
                time += this.flat.roomsTime
                time += this.flat.bath
            }

            if (this.service['repairs']) {
                price += this.repairs.price

                time += this.repairs.meters * this.service['repair_time']
                time += this.repairs.window * this.service['repair_window_time']
            }

            if (this.deliveryKey) {
                if (this.deliveryKey === 1) {
                    price += this.keyOne
                } else if (this.deliveryKey === 2) {
                    price += this.keyDuo
                }
            }

            price += this.additionals.price
            price += this.furnitures.price

            if (this.promocode.use) {
                price -= price / 100 * this.promocode.percent
            }

            this.price = price
            this.time = time
        },
        changePaymentsMethods(index) {
            if (this.systemPay === index) {
                this.systemPay = 0
            } else {
                this.systemPay = index
            }
            this.$v.systemPay.$touch()
        },
        changeDeliveryKeys(index) {
            if (this.deliveryKey === index) {
                this.deliveryKey = 0
            } else {
                this.deliveryKey = index
            }

            this.calc()
        },
        changeAddress(address) {
            console.log(address)
            if (address.id === this.address.id)
            {
                this.address.id = null
                this.address.street = null
                this.address.house = null
                this.address.apartament = null
                this.address.intercom = null
                this.address.floor = null
                this.address.entrance = null
            } else {
                this.address.id = address.id
                this.address.street = address.street
                this.address.house = address.house_number
                this.address.apartament = address.apartment_number
                this.address.intercom = address.intercom
                this.address.floor = address.floor
                this.address.entrance = address.entrance
            }
        },
        createOrder() {
            if (this.$v.$invalid) {
                this.$v.$touch()
                window.location.href = '#stepDuo'
                return
            }

            if (this.checkEmail()) {
                alert('почта используется')
                window.location.href = '#stepDuo'
                return
            }

            let params = {
                service_id: this.service.id,
                name: this.name,
                email: this.email,
                phone: this.phone,
                pay: this.systemPay,
                cleaning_date: this.date
            }

            if (this.auth && this.address.id)
            {
                params.address_id = this.address.id
            } else {
                params.street = this.address.street
                params.house_number = this.address.house
                params.apartment_number = this.address.apartament
                params.entrance = this.address.entrance
                params.floor = this.address.floor
                params.intercom = this.address.intercom
            }

            if (this.userid) {
                params.userid = this.userid
            }

            if (this.service['window']) {
                params.window_count = this.window.count
            }

            if (this.service['apartment']) {
                params.private_house = this.flat.private
                params.rooms = this.flat.rooms
                params.bathrooms = this.flat.bath
            }

            if (this.service['repairs']) {
                params.repair_m2 = this.repairs.meters
                params.repair_window = this.repairs.window

                if (this.repairs.stairs) {
                    params.repair_stairs = 1
                }
            }

            if (this.additionals.price > 0) {
                params.additionals = this.additionals.selected
                params.additionals_counts = this.additionals.count
            }

            axios.post('/api/orders/create', params).then(response => {
                alert('okay')
            }).catch(function (error) {
                alert('Not')
            })
        },
        checkEmail() {
            let params = {
                email: this.email
            }

            axios.post('/api/user/check/email', params).then(response => {
                if (response.data.data) {
                    if (response.data.data.status) {
                        // используется почта
                        return true
                    }
                }
            }).catch(function (error) {
                console.log(error);
            })

            return false
        }
    },
    watch: {
        price(newPrice)
        {
            // document.getElementById('btn-order').disabled = newPrice < 100
        },
        step(newStep)
        {
            if (newStep === 2)
            {
                setTimeout(() => {
                    window.location.href = '#stepDuo'
                }, 1)
            }
        }
    }
}
</script>

<style scoped>
    .is-invalid
    {
        background: #ee5a5a !important;
        border-color: #ee5a5a !important;
        color: white !important;
    }

    #promocode__inp {
        border-radius: 5px 0px 0px 5px;
    }

    #promocode__btn {
        border-radius: 0px 5px 5px 0px;
    }

    #btn-order:disabled:hover
    {
        cursor: not-allowed;
    }

    #btn-order:disabled
    {
        opacity: 0.7;
    }

    #buyButton {
        border-radius: 5px 0px 0px 5px;
    }

    #buyButton {
        border-radius: 0px 5px 5px 0px;
    }
    #buyButton:disabled:hover
    {
        cursor: not-allowed;
    }
    #buyButton:disabled
    {
        opacity: 0.7;
    }
</style>
