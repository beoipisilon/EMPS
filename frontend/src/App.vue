<template>
  <div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl font-bold text-center mb-8">Lista de Produtos (EMPS6)</h1>
      
      <div class="max-w-md mx-auto mb-8">
        <input
          v-model="searchTerm"
          @input="handleSearch"
          type="text"
          placeholder="Buscar produtos..."
          class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <SortControls
        :initial-sort-by="sortBy"
        :initial-sort-order="sortOrder"
        @sort-change="handleSortChange"
      />

      <div v-if="loading" class="text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
        <p class="mt-2 text-gray-600">Carregando produtos...</p>
      </div>

      <div v-else-if="error" class="text-center text-red-500">
        {{ error }}
        <button @click="fetchProducts" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
          Tentar novamente
        </button>
      </div>

      <div v-else-if="products.length === 0" class="text-center text-gray-500">
        Nenhum produto encontrado.
      </div>

      <div v-else>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <ProductCard
            v-for="product in products"
            :key="product.id"
            :product="product"
          />
        </div>

        <Pagination
          v-if="pagination"
          :pagination="pagination"
          @page-change="handlePageChange"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import ProductCard from './components/ProductCard.vue'
import Pagination from './components/Pagination.vue'
import SortControls from './components/SortControls.vue'

export default {
  name: 'App',
  components: {
    ProductCard,
    Pagination,
    SortControls
  },
  setup() {
    const products = ref([])
    const loading = ref(true)
    const error = ref(null)
    const searchTerm = ref('')
    const currentPage = ref(1)
    const sortBy = ref('preco')
    const sortOrder = ref('asc')
    const pagination = ref(null)

    const fetchProducts = async (search = '', page = 1) => {
      try {
        loading.value = true
        error.value = null
        
        const params = new URLSearchParams({
          search: search,
          page: page,
          per_page: 6,
          sort_by: sortBy.value,
          sort_order: sortOrder.value
        })
        
        const response = await axios.get(`https://163.5.124.28/backend/api/produtos.php?${params.toString()}`, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        
        if (response.data && response.data.data) {
          products.value = response.data.data
          pagination.value = response.data.pagination
        } else {
          products.value = []
          pagination.value = null
          console.error('Unexpected response format:', response.data)
        }
      } catch (err) {
        console.error('Erro ao carregar produtos:', err)
        if (err.response) {
          error.value = `Erro ao carregar produtos: ${err.response.status} ${err.response.statusText}`
          if (err.response.data && err.response.data.message) {
            error.value += ` - ${err.response.data.message}`
          }
        } else if (err.request) {
          if (err.message.includes('Network Error') || err.message.includes('CORS')) {
            error.value = 'Erro de CORS: O servidor não está permitindo requisições do frontend. Verifique se o servidor EMPS6 está rodando e se os headers CORS estão configurados corretamente.'
          } else {
            error.value = 'Não foi possível conectar ao servidor. Verifique se o servidor está rodando.'
          }
        } else {
          error.value = 'Erro ao configurar a requisição: ' + err.message
        }
      } finally {
        loading.value = false
      }
    }

    const handleSearch = () => {
      currentPage.value = 1
      fetchProducts(searchTerm.value, currentPage.value)
    }

    const handlePageChange = (page) => {
      currentPage.value = page
      fetchProducts(searchTerm.value, page)
    }

    const handleSortChange = ({ sortBy: newSortBy, sortOrder: newSortOrder }) => {
      sortBy.value = newSortBy
      sortOrder.value = newSortOrder
      currentPage.value = 1
      fetchProducts(searchTerm.value, currentPage.value)
    }

    onMounted(() => {
      fetchProducts()
    })

    return {
      products,
      loading,
      error,
      searchTerm,
      pagination,
      sortBy,
      sortOrder,
      handleSearch,
      handlePageChange,
      handleSortChange,
      fetchProducts
    }
  }
}
</script> 