<template>
  <div>
    <Head title="Import Fisier Conturi Bancare" />
    <h1 class="mb-8 text-3xl font-bold">Import Fisier Conturi Bancare</h1>
    <div class="flex items-center justify-between mb-6">
    </div>
    <div class="bg-white rounded-md shadow" style="padding: 10px;">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <file-input v-model="form.excelfile" :error="form.errors.excelfile" class="pb-8 pr-6 w-full lg:w-1/2" type="file" label="CSV" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Submit</loading-button>
        </div>
      </form>
    </div>
  <br />
    <div class="bg-white rounded-md shadow overflow-x-auto" style="padding: 10px;">
      <table class="w-full whitespace-nowrap table table-hover table-bordered" id="ANAFAngajatori_LOG">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Nr. Dosar</th>
            <th class="pb-4 pt-6 px-6">CNP/CUI Debitor</th>
            <th class="pb-4 pt-6 px-6">Denumire Debitor</th>
            <th class="pb-4 pt-6 px-6">Banca</th>
            <th class="pb-4 pt-6 px-6">Data Raspuns</th>
            <th class="pb-4 pt-6 px-6">Utilizator</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="organization in DosareDeschise.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              {{ organization.Dosar_Nr }}
            </td>
            <td class="border-t">
                {{ organization.CNPCUI_Debitor }}
            </td>
            <td class="border-t">
              {{ organization.Denumire_Debitor }}
            </td>
            <td class="border-t">
              {{ organization.Banca }}
            </td>
            <td class="border-t">
                {{ organization.Data_Raspuns }}
            </td>
            <td class="border-t">
                {{ organization.Utilizator }}
            </td>
          </tr>
          <tr v-if="DosareDeschise.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No data found.</td>
          </tr>
        </tbody>
      </table>
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
  props: {
    DosareDeschise: Object,
  },
  
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
    console.log('start of datatable');
    var table = $('#ANAFAngajatori_LOG').DataTable({
            orderCellsTop: true,
            fixedHeader: true
        });
  },
 
  methods: {
    store() {
      this.form.post('/ANAFBanci')
    },
  },
}

</script>
