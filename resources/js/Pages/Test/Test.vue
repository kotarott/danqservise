<template>
  <pre>{{questions}}</pre>
</template>

<script>
    import axios from 'axios'

    export default {
        props: ['type'],
        methods: {
            getData: function(){
              axios.post(route("question.getJSON", {"type": this.type}))
                .then(response => {
                  this.questions = response.data
                }) 
            }
        },
        created() {
          this.getData();
        },
        data() {
            return {
                questions: NaN
            }
        },
        components: {

        },
        computed: {

        }
    }
</script>