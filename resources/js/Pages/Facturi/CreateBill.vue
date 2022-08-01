<template>
  <div>
    <Head title="Creare Factura" />
    <h1 class="mb-8 text-3xl font-bold">Creare Factura</h1>
    <div class="flex items-center justify-between mb-6">
    </div>
    <form @submit.prevent="SaveBill">
    <div class="bg-white rounded-md shadow overflow-x-auto" style="padding: 10px;">
      <text-input v-model="form.order_receiver_name" :error="form.errors.order_receiver_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Nume Client 1" />
      <text-input v-model="form.order_receiver_address" :error="form.errors.order_receiver_address" class="pb-8 pr-6 w-full lg:w-1/2" label="Detalii Client" />

      <table class="w-full whitespace-nowrap table table-hover table-bordered" id="ANAFAngajatori_LOG">
                <thead>
                  <tr class="text-left font-bold">
                    <th width="5%">Nr. Crt.</th>
                    <th width="15%">Nr.Dosar</th>
                    <th width="15%">Nume Produs</th>                      
                    <th width="15%">Cantitate</th>
                    <th width="10%">Pret/buc</th>
                    <th width="10%">Total Fara Taxe</th>
                    <th width="10%" colspan="2">TVA (%)</th>
                    <th width="8%" rowspan="2">Total</th>
                    <th width="10%"> Clone row button</th>
                  </tr>
                  <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>%</th>
                      <th>LEI</th>

                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(organization, index) in form.xyz" class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                    {{ index+1 }} 
                    </td>
                    <td class="border-t">
                      <input type="text"  v-model="form.xyz[index].Nr_Dosar"  :id="'Detalii' + index" class="form-input" />
                    </td>
                    <td class="border-t">
                      <select v-model="form.xyz[index].item_name" class="form-input" >
                        <option value="">Select Product</option>
                        <option v-for="prod in Product.data" :value="prod.Nume_Prod">{{prod.Nume_Prod}}</option>
                      </select>
                    </td>
                    <td class="border-t">
                      <input type="text" v-model="form.xyz[index].order_item_quantity" v-on:blur="cal_final_total" :id="'order_item_quantity' + index"  v-bind:data-srno="index" class="form-input"/>
                    </td>
                    <td class="border-t">
                      <input type="text" v-model="form.xyz[index].order_item_price" v-on:blur="cal_final_total" :id="'order_item_price'+index" v-bind:data-srno="index" class="form-input" />
                    </td>
                    <td class="border-t">
                      <input type="text" v-model="form.xyz[index].order_item_actual_amount" :id="'order_item_actual_amount'+index" v-bind:data-srno="index" class="form-input" />
                    </td>
                    <td class="border-t">
                      <input type="text" v-model="form.xyz[index].order_item_tax1_rate" :id="'order_item_tax1_rate'+index" v-bind:data-srno="index" class="form-input" />
                    </td>
                    <td class="border-t">
                      <input type="text" v-model="form.xyz[index].order_item_tax1_amount" :id="'order_item_tax1_amount'+index" v-bind:data-srno="index" class="form-input" />
                    </td>
                    <td class="border-t">
                      <input type="text" v-model="form.xyz[index].order_item_final_amount" :id="'order_item_final_amount'+index" v-bind:data-srno="index" class="form-input" />
                    </td>
                    <td class="border-t">
                      <button type="button" class="hover:underline" @click="cloneRow(index)">Clone</button>
                      <button type="button" class="text-red-600 hover:underline" v-show="index > 0" @click="deleteRow(index)">Delete</button>
                    </td>
                  </tr>
                  <tr v-if="form.xyz.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No data found.</td>
                  </tr>
                </tbody>
      </table>
        <button type="button" class="btn-indigo" style="float: right;"  @click="addRow()">Add</button>
        <table class="w-full whitespace-nowrap table table-hover table-bordered" id="ANAFAngajatori_LOG">
          <tr>
              <td align="right"><b>Total</b></td>
              <td align="right"><b><span id="final_total_amt">{{total_amount_final_amount}}</span></b></td>
          </tr>
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
import TextInput from '@/Shared/TextInput'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    LoadingButton,
    Head,
    Icon,
    Link,
    TextInput,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    Nume_Client: Object,
    Detalii_Client: Object,
    ClientAll: Object,
    Product: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        order_receiver_name: this.Nume_Client,
        order_receiver_address: this.Detalii_Client,
        xyz: this.ClientAll.data,
        count: 0,
        final_item_total: 0,
      }),
      total_amount_final_amount: null,
    }
  },
  
  mounted(){
    console.log("here in mounted functions");
    console.log(this.Product);
    this.count = this.form.xyz.length;
  },
 
  methods: {
    
    SaveBill() {
      this.form.post('/Createbill')
    },
    cloneRow(_index) {
      this.count++;
      
      this.form.xyz.splice(_index+1, 0 , {
        Nr_Dosar: this.form.xyz[_index].Nr_Dosar,
        item_name: this.form.xyz[_index].item_name,
        order_item_quantity: this.form.xyz[_index].order_item_quantity,
        order_item_price: this.form.xyz[_index].order_item_price,
        order_item_actual_amount: this.form.xyz[_index].order_item_actual_amount,
        order_item_tax1_rate: this.form.xyz[_index].order_item_tax1_rate,
        order_item_tax1_amount: this.form.xyz[_index].order_item_tax1_amount,
        order_item_final_amount: this.form.xyz[_index].order_item_final_amount,

      });
      this.cal_final_total();
      //this.form.xyz.splice(_index+1, 0 , this.ClientAll.data[_index]);
    },
    deleteRow(_index) {
      this.count--;
      this.form.xyz.splice(_index, 1);
      this.cal_final_total(); 
    },
    addRow() {
      this.count++;
      this.form.xyz.push({
        Nr_Dosar: null,
        order_item_tax1_rate: 19,
      });
    },
    cal_final_total() {
      var final_item_total = 0;
      for (let i = 0; i < this.form.xyz.length; i++) {
          if(this.form.xyz[i].order_item_quantity > 0) {
            
            if(this.form.xyz[i].order_item_price > 0) {
               var actual_amount = parseFloat(this.form.xyz[i].order_item_quantity) * parseFloat(this.form.xyz[i].order_item_price);
               this.form.xyz[i].order_item_actual_amount = actual_amount;

               if(this.form.xyz[i].order_item_tax1_rate > 0) {
                  var tax1_amount = parseFloat(actual_amount) * parseFloat(this.form.xyz[i].order_item_tax1_rate) / 100;
                  this.form.xyz[i].order_item_tax1_amount = tax1_amount;
               }

               var item_total = parseFloat(actual_amount) + parseFloat(tax1_amount);
               final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
               this.form.xyz[i].order_item_final_amount = item_total;
            }  
          }
        }
        this.total_amount_final_amount = final_item_total;
    },
  },
}
       
</script>
