import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  server: {
    proxy: {
      '^/api/.*': {
        target: 'http://163.5.124.28/backend',
        changeOrigin: true,
        secure: false,
        rewrite: (path) => path
      }
    }
  }
}) 