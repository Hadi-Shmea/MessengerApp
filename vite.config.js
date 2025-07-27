import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',
        'resources/js/messages.js',
        'resources/css/app.css',
      ],
      refresh: true,
    }),
    vue(),
  ],
  resolve: {
    alias: {
      // 👇 This line is crucial for template compilation at runtime
      'vue': 'vue/dist/vue.esm-bundler.js',
    },
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks: {
          vue: ['vue'],
        },
      },
    },
  },
});

// import { defineConfig } from 'vite';
// import vue from '@vitejs/plugin-vue';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/js/app.js',
//                 'resources/js/messages.js',
//                 'resources/css/app.css',
//             ],
//             refresh: true,
//         }),
//         vue(),
//     ],
//     build: {
//         rollupOptions: {
//             output: {
//                 manualChunks: {
//                     vue: ['vue'],
//                 },
//             },
//         },
//     },
// });

// import { defineConfig } from 'vite';
// import vue from '@vitejs/plugin-vue';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/js/app.js',
//             ],
//             refresh: true,
//         }),
//         vue(),
//     ],
// });
