<template xmlns="http://www.w3.org/1999/html">
    <div>
        <b-button v-on:click="logThis" > I am a button </b-button>
        <b-list-group>
            <b-list-group-item v-for="reservation in reservations">
                {{ reservation.id }} {{ reservationStatus[reservation.status] }}
            </b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
export default {
    name: "Home",

    data() {
        return {
            reservations: [],
            reservationStatus: {}
        };
    },
    methods: {
        logThis: function () {
            console.log(this.reservationStatus['CANC_AD'])

            axios.get('api/v1/reservations')
                .then((response) => {
                    console.log(response.data)
                    this.reservations = response.data
                })
                .catch((error) => {
                    console.log(error)
                });
        },
    },
    mounted() {
        axios.get('api/v1/reservations/status')
            .then((response) => {
                console.log(response.data)
                response.data.forEach(element => console.log(element.description));
                response.data.forEach(element => this.reservationStatus[element.status] = element.description);
            })
            .catch((error) => {
                console.log(error)
            });
    }
}
</script>

<style scoped>

</style>
