<template>
    <feather-icon icon="CircleIcon" :svgClasses="['fill-current h-4 w-4', textColor]" />
</template>

<script>
export default {
  name: 'CellRendererPaymentVerified',
  computed: {
    textColor () {
      return this.params.value === 1 ? 'text-primary' : 'text-grey'
    }
  }
}
</script>
