<template>
  <div>
    <Head title="Creare Factura" />
    <h1 class="mb-8 text-3xl font-bold">Creare Factura</h1>
    <div class="flex items-center justify-between mb-6">
    </div>
    <form @submit.prevent="Createbill">
    <div class="bg-white rounded-md shadow overflow-x-auto" style="padding: 10px;">
      <table class="w-full whitespace-nowrap table table-hover table-bordered" id="ANAFAngajatori_LOG">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Select</th>
            <th class="pb-4 pt-6 px-6">Nr Dosar</th>
            <th class="pb-4 pt-6 px-6">Nume Creditor(client)</th>
            <th class="pb-4 pt-6 px-6">Detalii Creditor(client)</th>
            <th class="pb-4 pt-6 px-6">Adresa Creditor(client)</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="organization in DosareDeschise.data" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <input type="checkbox" v-model="form.records" name="records" :value="organization.Nr_Dosar">
            </td>
            <td class="border-t">
              {{ organization.Nr_Dosar }}
            </td>
            <td class="border-t">
                {{ organization.Nume_Creditor }}
            </td>
            <td class="border-t">
                {{ organization.Detalii_Client }}
            </td>
            <td class="border-t">
                {{ organization.Adresa_Client }}
            </td>
          </tr>
          <tr v-if="DosareDeschise.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No data found.</td>
          </tr>
        </tbody>
      </table>

      
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Creaza</loading-button>
      
    </div>
    </form>
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


import $ from 'jquery'; 


import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'

import LoadingButton from '@/Shared/LoadingButton'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    LoadingButton,
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    DosareDeschise: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        records: []
      }),
    }
  },
  props: {
    DosareDeschise: Object,
  },
  mounted(){
    
    var table = $('#ANAFAngajatori_LOG').DataTable({
            orderCellsTop: true,
            fixedHeader: true
        });
  },
 
  methods: {
    Createbill() {
      this.form.post('/Createbill')
    },
  },
}

</script>
