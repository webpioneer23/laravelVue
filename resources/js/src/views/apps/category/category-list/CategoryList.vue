<!-- =========================================================================================
  File Name: UserList.vue
  Description: User List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>

  <div id="page-user-list">

    

    <div class="vx-card p-6">

      <div class="flex flex-wrap items-center">

        <!-- ITEMS PER PAGE -->
        <div class="flex-grow">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
              <span class="mr-2">{{ currentPage * paginationPageSize - (paginationPageSize - 1) }} - {{ usersData.length - currentPage * paginationPageSize > 0 ? currentPage * paginationPageSize : usersData.length }} of {{ usersData.length }}</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>
            <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
            <vs-dropdown-menu>

              <vs-dropdown-item @click="gridApi.paginationSetPageSize(10)">
                <span>10</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                <span>20</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(25)">
                <span>25</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(30)">
                <span>30</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>

        <!-- TABLE ACTION COL-2: SEARCH & EXPORT AS CSV -->
          <vs-input class="sm:mr-4 mr-0 sm:w-auto w-full sm:order-normal order-3 sm:mt-0 mt-4" v-model="searchQuery" @input="updateSearchQuery" placeholder="Search..." />
          <!-- <vs-button class="mb-4 md:mb-0" @click="gridApi.exportDataAsCsv()">Export as CSV</vs-button> -->

          <!-- ACTION - DROPDOWN -->
          <vs-dropdown vs-trigger-click class="cursor-pointer">

            <div class="p-3 shadow-drop rounded-lg d-theme-dark-light-bg cursor-pointer flex items-end justify-center text-lg font-medium w-32">
              <span class="mr-2 leading-none">Actions</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>

            <vs-dropdown-menu>

              <vs-dropdown-item>
                <span class="flex items-center">
                  <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
                  <span>Delete</span>
                </span>
              </vs-dropdown-item>

              <vs-dropdown-item>
                <span class="flex items-center">
                  <feather-icon icon="ArchiveIcon" svgClasses="h-4 w-4" class="mr-2" />
                  <span>Archive</span>
                </span>
              </vs-dropdown-item>

              <vs-dropdown-item>
                <span class="flex items-center">
                  <feather-icon icon="FileIcon" svgClasses="h-4 w-4" class="mr-2" />
                  <span>Print</span>
                </span>
              </vs-dropdown-item>

              <vs-dropdown-item>
                <span class="flex items-center">
                  <feather-icon icon="SaveIcon" svgClasses="h-4 w-4" class="mr-2" />
                  <span>CSV</span>
                </span>
              </vs-dropdown-item>

            </vs-dropdown-menu>
          </vs-dropdown>
      </div>


      <!-- AgGrid Table -->
      <ag-grid-vue
        ref="agGridTable"
        :components="components"
        :gridOptions="gridOptions"
        class="ag-theme-material w-100 my-4 ag-grid-table"
        :columnDefs="columnDefs"
        :defaultColDef="defaultColDef"
        :rowData="usersData"
        rowSelection="multiple"
        colResizeDefault="shift"
        :animateRows="true"
        :floatingFilter="true"
        :pagination="true"
        :paginationPageSize="paginationPageSize"
        :suppressPaginationPanel="true"
        :enableRtl="$vs.rtl">
      </ag-grid-vue>

      <vs-pagination
        :total="totalPages"
        :max="7"
        v-model="currentPage" />

    </div>
  </div>

</template>

<script>
import { AgGridVue } from 'ag-grid-vue'
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

// Cell Renderer
import CellRendererLink from './cell-renderer/CellRendererLink.vue'
import CellRendererStatus from './cell-renderer/CellRendererStatus.vue'
import CellRendererVerified from './cell-renderer/CellRendererVerified.vue'
import CellRendererPaymentVerified from './cell-renderer/CellRendererPaymentVerified.vue'
import CellRendererActions from './cell-renderer/CellRendererActions.vue'
import CellRenderDate from './cell-renderer/CellRenderDate.vue'
import axios from '@/axios.js'



export default {
  components: {
    AgGridVue,
    vSelect,

    // Cell Renderer
    CellRenderDate,
    CellRendererLink,
    CellRendererStatus,
    CellRendererVerified,
    CellRendererPaymentVerified,
    CellRendererActions
  },
  created () {
    //  this.getCountries();
    if (!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }
    this.$store.dispatch('userManagement/fetchUsers').catch(err => { console.error(err) });
    

    this.$store.dispatch('userManagement/fetchCountries')
    // .then((response) => {
    //   console.log('ghosy', response.data); 
    //   this.countries=response.data;
    //   console.log("created_countries", this.countries)
    //   })
    .catch(err => { console.error(err) })
  },
  data () {
      var countries=[
        { label: 'All', value: 'all' },
        { label: 'fr', value: 'fr' },
        { label: 'ru', value: 'ru' },
      ];
      // let test="test";
    return {
      countries:[],
   
      // Filter Options
      countryFilter:{ label: 'All', value: 'all' },
      countryOptions: countries,

      roleFilter: { label: 'All', value: 'all' },
      roleOptions: [
        { label: 'All', value: 'all' },
        { label: 'Admin', value: 'admin' },
        { label: 'User', value: 'user' },
        { label: 'Staff', value: 'staff' }
      ],

      statusFilter: { label: 'All', value: 'all' },
      statusOptions: [
        { label: 'All', value: 'all' },
        { label: 'Active', value: 'active' },
        { label: 'Trial', value: 'trial' },
        { label: 'Free', value: 'free' },
        { label: 'Pending', value: 'pending' }
      ],

      paymentStatusFilter: { label: 'All', value: 'all' },
      paymentStatusOptions: [
        { label: 'All', value: 'all' },
        { label: 'Yes', value: 1 },
        { label: 'No', value: 0 }
      ],

      isVerifiedFilter: { label: 'All', value: 'all' },
      isVerifiedOptions: [
        { label: 'All', value: 'all' },
        { label: 'Yes', value: 1 },
        { label: 'No', value: 0 }
      ],

      departmentFilter: { label: 'All', value: 'all' },
      departmentOptions: [
        { label: 'All', value: 'all' },
        { label: 'Sales', value: 'sales' },
        { label: 'Development', value: 'development' },
        { label: 'Management', value: 'management' }
      ],

      searchQuery: '',

      // AgGrid
      gridApi: null,
      gridOptions: {},
      defaultColDef: {
        sortable: true,
        resizable: true,
        suppressMenu: true
      },
      columnDefs: [
        {
          headerName: 'ID',
          field: 'id',
          width: 150,
          filter: true,
          checkboxSelection: true,
          headerCheckboxSelectionFilteredOnly: true,
          headerCheckboxSelection: true
        },
        {
          headerName: 'Owner Name',
          field: 'name',
          filter: true,
          width: 280,
          cellRendererFramework: 'CellRendererLink'
        },
        {
          headerName: 'Created Date',
          field: 'created_at',
          filter: true,
          width: 325,
        },
        {
          headerName: 'Country',
          field: 'country',
          filter: true,
          width: 200
        },
        {
          headerName: 'Payment Status',
          field: 'payment_status',
          filter: true,
          width: 200,
          cellRendererFramework:'CellRendererVerified'
        },
      
        {
          headerName: 'Status',
          field: 'status',
          filter: true,
          width: 200,
          cellRendererFramework: 'CellRendererStatus'
        },
        {
          headerName: 'Verified',
          field: 'verified',
          filter: true,
          width: 155,
          cellRendererFramework: 'CellRendererVerified',
          cellClass: 'text-center'
        },
        {
          headerName: 'Actions',
          field: 'transactions',
          width: 200,
          cellRendererFramework: 'CellRendererActions'
        }
      ],

      // Cell Renderer Components
      components: {
        CellRenderDate,
        CellRendererPaymentVerified,
        CellRendererLink,
        CellRendererStatus,
        CellRendererVerified,
        CellRendererActions
      }
    }
  },
  watch: {
    countryFilter (obj) {
      this.setColumnFilter('country', obj.value)
    },
    roleFilter (obj) {
      this.setColumnFilter('role', obj.value)
    },
    statusFilter (obj) {
      this.setColumnFilter('status', obj.value)
    },
    
    paymentStatusFilter (obj) {
      this.setColumnFilter('payment_status', obj.value)
    },

    isVerifiedFilter (obj) {
      // const val = obj.value === 'all' ? 'all' : obj.value === 1 ? 'true' : 'false'
      this.setColumnFilter('verified', obj.value)
    },
    departmentFilter (obj) {
      this.setColumnFilter('department', obj.value)
    }
  },
  computed: {
    usersData () {
      return this.$store.state.userManagement.users
    },
   
    paginationPageSize () {
      if (this.gridApi) return this.gridApi.paginationGetPageSize()
      else return 10
    },
    totalPages () {
      if (this.gridApi) return this.gridApi.paginationGetTotalPages()
      else return 0
    },
    currentPage: {
      get () {
        if (this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1
        else return 1
      },
      set (val) {
        this.gridApi.paginationGoToPage(val - 1)
      }
    }
  },
  methods: {
    // getCountries(){
    //     axios.get('/api/countries')
    //       .then((response) => {
    //         console.log("country_response", response.data)
    //         app.countries=[
    //             { label: 'All', value: 'all' },
    //             { label: 'fr', value: 'fr' },
    //             { label: 'ru', value: 'ru' },
    //         ]
    //         console.log("sdf",app.countries);
    //       })
    //       .catch((error) => { console.log(error) })
    // },
    setColumnFilter (column, val) {
      const filter = this.gridApi.getFilterInstance(column)
      let modelObj = null

      if (val !== 'all') {
        modelObj = { type: 'equals', filter: val }
      }

      filter.setModel(modelObj)
      this.gridApi.onFilterChanged()
    },
    resetColFilters () {
      // Reset Grid Filter
      this.gridApi.setFilterModel(null)
      this.gridApi.onFilterChanged()

      // Reset Filter Options
      this.countryFilter = this.paymentStatusFilter = this.statusFilter = this.isVerifiedFilter = this.departmentFilter = { label: 'All', value: 'all' }

      this.$refs.filterCard.removeRefreshAnimation()
    },
    updateSearchQuery (val) {
      this.gridApi.setQuickFilter(val)
    }
  },
  mounted () {
    this.gridApi = this.gridOptions.api

    /* =================================================================
      NOTE:
      Header is not aligned properly in RTL version of agGrid table.
      However, we given fix to this issue. If you want more robust solution please contact them at gitHub
    ================================================================= */
    if (this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector('.ag-header-container')
      header.style.left = `-${  String(Number(header.style.transform.slice(11, -3)) + 9)  }px`
    }
  }
}

</script>

<style lang="scss">
#page-user-list {
  .user-list-filters {
    .vs__actions {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-58%);
    }
  }
}
</style>
