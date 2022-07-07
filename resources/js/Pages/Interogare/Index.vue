<template>
  <div>
    <Head title="Emitere Interogari" />
    <h1 class="mb-8 text-3xl font-bold">Emitere Interogari</h1>
    <div class="flex items-center justify-between mb-6">
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto" style="padding: 10px;">
      <table class="w-full whitespace-nowrap table table-hover table-bordered" id="example">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Istoric</th>
            <th class="pb-4 pt-6 px-6">Dosar nr.</th>
            <th class="pb-4 pt-6 px-6">CNP/CUI DEBITOR</th>
            <th class="pb-4 pt-6 px-6">Nume Debitor</th>
            <th class="pb-4 pt-6 px-6">Prenume Debitor</th>
            <th class="pb-4 pt-6 px-6">An Dosar</th>        
            <th class="pb-4 pt-6 px-6">Nume Creditor</th>
            <th class="pb-4 pt-6 px-6">Data Emitere Interogare</th>
            <th class="pb-4 pt-6 px-6">Stadiu Dosar</th>
            <th class="pb-4 pt-6 px-6">Utilizator</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="organization in DosareDeschise.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="``">
                Istoric
              </Link>
            </td>
            <td class="border-t">
              {{ organization.Nr_Dosar }}
            </td>
            <td class="border-t">
                {{ organization.CNP_CUI }}
            </td>
            <td class="border-t">
              {{ organization.Nume_Debitor }}
            </td>
            <td class="border-t">
              {{ organization.Prenume_Debitor }}
            </td>
            <td class="border-t">
                {{ organization.AN_d }}
            </td>
            <td class="border-t">
                {{ organization.Nume_Creditor }}
            </td>
            <td class="border-t">
                {{ organization.DataEmitere_Interogare }}
            </td>
            <td class="border-t">
                {{ organization.Stadiu_Dosar }}
            </td>
            <td class="border-t">
                {{ organization.ID_UserEmInt }}
            </td>
          </tr>
          <tr v-if="DosareDeschise.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No data found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="DosareDeschise.links" />
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
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
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
  mounted(){
    table = $('#example').DataTable({dom: 'Bfrtip',
                                                    select: true,
                                                    lengthMenu: [
                                                        [10, 25, 50, -1],
                                                        ['10 randuri', '25 randuri', '50 randuri', 'Aratat tot']
                                                    ],
                                                    buttons: [
                                                        'pageLength',
                                                        {
                                                            text: 'Selecteaza Tot',
                                                            action: function () {
                                                                table.rows().select();
                                                            }
                                                        },
                                                        {
                                                            text: 'Deselecteaza tot',
                                                            action: function () {
                                                                table.rows().deselect();
                                                            }
                                                        },
                                                        
                                                        {
                                                            extend: 'csvHtml5',
                                                            title: null,
                                                            exportOptions: {
                                                                columns: '2, 3',
                                                                rows: ':visible',
                                                                modifier: {
                                                                    selected: true
                                                                }
                                                            },
                                                            
                                                            
                                                        },
                                                    ],
                                                    
                                                    "rowCallback": function (row, data) {
                                                        if (data[7] == "Inchis") {
                                                            $('td', row).css('background-color', '#519ebd');
                                                            ;
                                                        }
                                                    },
                                                    "columnDefs": [{
                                                            "searchable": false,
                                                            "orderable": false,
                                                            "targets": 0,
                                                        }]
                                                });
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/organizations', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    destroy(id) {
      if (confirm('Are you sure you want to delete this Interogare?')) {
        this.$inertia.delete(`/DosareDeschise/${id}`)
      }
    },
  },
}

$(document).on('click', '.buttons-csv', function () {
    
    var data=table.rows( { selected: true }).data();
    for (var i=0; i < data.length; i++){
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = "/interogare_data";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                '_token': token,
                'id': data[i][1]
            },
            success: function(response) {
                var jsn_res = JSON.parse(response);
                if (jsn_res.success) {
                    toastr.success(jsn_res.success);
                    $("#open_update_domain_dns_modal").text('need to be updated');
                    $('#update_domain_route_modal').modal('hide');
                } else if (jsn_res.error) {
                    toastr.success(jsn_res.error);
                }
                $(".loading").hide();
            }
        });
        
        
        console.log(data[i][1]);
    }  
    
});


</script>
