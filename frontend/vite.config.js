import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { resolve } from 'path'
import fs from 'fs/promises'

// Custom plugin to move index.html to blade template
function moveHtmlToBlade() {
  return {
    name: 'move-html-to-blade',
    closeBundle: async () => {
      const destDir = resolve(__dirname, '../backend/resources/views');
      const src = resolve(__dirname, '../backend/public/index.html');
      const dest = resolve(destDir, 'frontend.blade.php');

      try {
        await fs.rename(src, dest);
        console.log(`Moved ${src} to ${dest}`);
      } catch (e) {
        console.error('Failed to move index.html to frontend.blade.php', e);
      }
    }
  }
}

// https://vite.dev/config/
export default defineConfig({
  plugins: [react(), moveHtmlToBlade()],
  build: {
    outDir: '../backend/public',
    emptyOutDir: false,
  }
})
