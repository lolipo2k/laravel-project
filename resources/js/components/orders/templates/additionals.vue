<template>
    <div v-show="this.list.length">
        <div class="common__title add-title" v-show="type === 1">Wybierz usługi</div>
        <div class="common__title add-title" v-show="type === 2">Dodatkowe usługi</div>
        <div class="additional__list">
            <div class="additional__item add-service" :class="{ _active: selected.indexOf(item.id) !== -1 }" v-for="item in list">
                <label class="additional__label" @click="changeItem(item.id, item.price)"></label>

                <div class="additional__img">
                    <img :src="item.images" alt="Photo">
                </div>

                <div class="add-form__item" :class="{ _single: !item.multi }">
                    <div class="clean__minus add-minus" @click="changeTakeCount(item.id)">-</div>
                    <span class="add-inner">{{ selectedCount[item.id] + 1 }}</span>
                    <div class="clean__plus add-plus" @click="changeAddCount(item.id)">+</div>
                </div>

                <div class="additional__text">{{ item.name }}</div>
                <div class="additional__price">{{ item.price.toFixed(2) }} zł</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "additionals",
    props: {
        list: Array,
        type: Number,
    },
    data() {
        return {
            selected: [],
            selectedCount: []
        }
    },
    methods: {
        changeItem(id) {
            if (this.selected.indexOf(id) !== -1)
            {
                let index = this.selected.indexOf(id)

                if (index > -1)
                {
                    this.selected.splice(index, 1)
                }
            } else {
                this.selected.push(id)
                if (!this.selectedCount[id])
                {
                    this.$set(this.selectedCount, id, 0)
                }
            }

            this.calc()
        },
        changeAddCount(id)
        {
            if (this.selectedCount[id])
            {
                let count = this.selectedCount[id]
                count++
                this.$set(this.selectedCount, id, count)
            } else {
                this.$set(this.selectedCount, id, 1)
            }

            this.calc()
        },
        changeTakeCount(id)
        {
            if (this.selectedCount[id] > 0)
            {
                let count = this.selectedCount[id]
                count--
                this.$set(this.selectedCount, id, count)
                this.calc()
            }
        },
        calc()
        {
            let price = 0

            for(let i = 0; i < this.list.length; i++) {
                if (this.selected.indexOf(this.list[i].id) !== -1)
                {
                    price += this.list[i].price
                }

                if (this.selectedCount[this.list[i].id] && this.selected.indexOf(this.list[i].id) !== -1)
                {
                    price += this.selectedCount[this.list[i].id] * this.list[i].price
                }
            }

            this.$emit('changePrice', {
                price: price,
                selected: this.selected,
                selectedCount: this.selectedCount

            })
        }
    },
}
</script>

<style scoped>

</style>
