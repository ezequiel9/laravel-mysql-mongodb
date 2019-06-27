<template>
    <div>
        <b-container fluid class="home-slider-container">
            <b-container>
                <b-jumbotron :header="header" :lead="subHeading">
                    <p>Fdipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <b-btn variant="dark" href="">More Info</b-btn>
                </b-jumbotron>
            </b-container>
        </b-container>
    </div>
</template>

<script>
    export default {
        name: "home-slider",
        data(){
            return {
                header: 'Have a read our blog.',
                subHeading: 'Lorem ipsum dolor sit amet, consectetur.'
            }
        }
    }
</script>
