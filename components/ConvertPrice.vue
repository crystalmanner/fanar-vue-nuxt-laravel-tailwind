<template>
  <span>{{result}}</span>
</template>

<script>
  export default {
    props: ['price'],
    computed: {
      currency() {
        return this.$store.state.currency;
      },
      currentRate() {
        return this.$store.state.currentRate;
      },
      result() {
        if(this.currency === 'try') {
          return this.price
        }
        else {
          return parseFloat((parseFloat(this.price.replace(/,/g, '')) / this.currentRate)).toFixed(2);
        }
      },
    },
  }
</script>

