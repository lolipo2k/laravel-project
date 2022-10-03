<template>
    <div class="common__date">
        <div class="common__title">
            Wybierz datę
        </div>
        <div class="datePicker">
            <input id="datePick" type="hidden" name="date">
            <input id="datePick2" type="hidden" name="time" value="00:00:00">
        </div>
        <div class="common__title">
            Wybierz godzinę
        </div>
        <div class="common__days">
            <div class="days__item" v-for="time in AllHors" :class="{ '_active-2': hors === time }" @click="setHours(time)">
                {{ time }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "date",
    data() {
        return {
            hors: null,
            test: null,
            AllHors: [ '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30' ]
        }
    },
    mounted() {
        this.hors = '9:00'

        datepicker('#datePick', {
            formatter: (input, date, instance) => {
                const value = date.toISOString().split('T')[0]
                input.value = value
            },
            alwaysShow: true, // Never hide the calendar.
            dateSelected: new Date(), // Today is selected.
            maxDate: new Date(2099, 0, 1), // Jan 1st, 2099.
            minDate: new Date(), // June 1st, 2016.
            startDate: new Date(), // This month.
            startDay: 1,
            showAllDates: false, // Numbers for leading & trailing days outside the current month will show.
            customMonths: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
            customDays: ['N', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
            onSelect: (input, instance, date) => {
                this.createTimes()
            },
        })

        this.createTimes()
    },
    methods: {
        setHours(time)
        {
            this.hors = time
            this.createTimes()
        },
        createTimes ()
        {
            console.log(`${document.getElementById('datePick').value} ${this.hors}:00`)
            this.$emit('changeTime', `${document.getElementById('datePick').value} ${this.hors}:00`)
        }
    }
}
</script>

<style scoped>

</style>
