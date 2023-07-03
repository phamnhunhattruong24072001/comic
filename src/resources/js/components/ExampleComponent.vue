<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Haha ta đã vào được Vuejs</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                    <button @click="showText">Show text</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            showText() {
                console.log('This is show test 1')
            }
        }
    }
</script>
