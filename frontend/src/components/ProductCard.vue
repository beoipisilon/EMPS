<template>
  <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 bg-red-500">
    <div class="p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ product.nome }}</h2>
      <p class="text-gray-600 mb-4">{{ product.descricao }}</p>
      <div class="flex justify-between items-center">
        <span class="text-2xl font-bold text-blue-600">R$ {{ product.preco.toFixed(2) }}</span>
        <span class="text-sm text-gray-500">ID: {{ product.id }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductCard',
  props: {
    product: {
      type: Object,
      required: true
    }
  }
}
</script> 