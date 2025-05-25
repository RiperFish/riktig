import { resolve } from "path";
import FullReload from "vite-plugin-live-reload";
import tailwindcss from "@tailwindcss/vite";
import { viteStaticCopy } from "vite-plugin-static-copy";
export default {
  base: "/",
  root: ".",
  build: {
    manifest: true,
    outDir: "public",
    emptyOutDir: true,
    rollupOptions: {
      input: ["resources/css/style.css", "resources/js/main.js"],
      //refresh: true,
    },
  },
  server: {
    origin: "http://localhost:5173",
    cors: true,
    port: 5173,
    strictPort: true,
    watch: {
      usePolling: true,
    },
  },
  plugins: [
    tailwindcss(),
    viteStaticCopy({
      targets: [
        {
          src: "resources/static/**/*",
          dest: "images",
        },
      ],
    }),
    FullReload(["./**/*.php"]),
  ],
};
