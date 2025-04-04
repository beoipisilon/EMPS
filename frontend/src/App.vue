<template>
  <div class="min-h-screen bg-gray-100 py-8">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl font-bold text-center mb-8">Lista de Produtos</h1>
      
      <div class="max-w-md mx-auto mb-8">
        <input
          v-model="searchTerm"
          @input="handleSearch"
          type="text"
          placeholder="Buscar produtos..."
          class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <div v-if="loading" class="text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
        <p class="mt-2 text-gray-600">Carregando produtos...</p>
      </div>

      <div v-else-if="error" class="text-center text-red-500">
        {{ error }}
      </div>

      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <ProductCard
          v-for="product in products"
          :key="product.id"
          :product="product"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import ProductCard from './components/ProductCard.vue'

export default {
  name: 'App',
  components: {
    ProductCard
  },
  setup() {
    const products = ref([])
    const loading = ref(true)
    const error = ref(null)
    const searchTerm = ref('')

    const fetchProducts = async (search = '') => {
      try {
        loading.value = true
        error.value = null
        const response = await axios.get(`/api/produtos${search ? `?search=${search}` : ''}`)
        products.value = response.data
      } catch (err) {
        error.value = 'Erro ao carregar produtos. Por favor, tente novamente.'
        console.error(err)
      } finally {
        loading.value = false
      }
    }

    const handleSearch = () => {
      fetchProducts(searchTerm.value)
    }

    onMounted(() => {
      fetchProducts()
    })

    return {
      products,
      loading,
      error,
      searchTerm,
      handleSearch
    }
  }
}
</script> 