<template>
  <div>
    <Head title="Import Fisier Angajatori" />
    <h1 class="mb-8 text-3xl font-bold">Import Fisier Angajatori</h1>
    <div class="flex items-center justify-between mb-6">
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto" style="padding: 10px;">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <file-input v-model="form.excelfile" :error="form.errors.excelfile" class="pb-8 pr-6 w-full lg:w-1/2" type="file" label="CSV" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Submit</loading-button>
        </div>
      </form>
    </div>
    
  </div>
</template>



<script>
var table = "";
//Bootstrap and jQuery libraries

import 'jquery/dist/jquery.min.js';
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import "datatables.net-buttons/js/dataTables.buttons.js"
import 'datatables.net-select-dt'
import "datatables.net-buttons/js/buttons.colVis.js"
import "datatables.net-buttons/js/buttons.flash.js"
import "datatables.net-buttons/js/buttons.html5.js"
import "datatables.net-buttons/js/buttons.print.js"

import $ from 'jquery'; 


import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'
import LoadingButton from '@/Shared/LoadingButton'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    FileInput,
    LoadingButton,
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        excelfile: null,
      }),
    }
  },
  props: {
    DosareDeschise: Object,
  },
  mounted(){

  },
 
  methods: {
    store() {
      this.form.post('/ANAFAngajatori')
    },
  },
}

</script>
