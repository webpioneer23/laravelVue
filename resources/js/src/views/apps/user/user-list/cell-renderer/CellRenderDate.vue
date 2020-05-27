<template>
    <feather-icon icon="CircleIcon" :svgClasses="['fill-current h-4 w-4', textColor]" />
</template>



<script>

import moment from 'moment';

export default {
  name: 'CellRenderDate',
  computed: {
    text() {
      return "2020-05-25"; 
      // return moment(this.params.value).format("MMM Do YY"); 
      // return this.params.value === 1 ? 'text-primary' : 'text-grey'
    }
  }
}
</script>
