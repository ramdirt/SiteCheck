<script setup>
</script>

<template lang="pug">
.min-h-screen.flex.flex-col.items-center.pt-6.bg-gray-100(
  class="sm:justify-center sm:pt-0"
)
  div
    Link(href="/")
      img(src="/images/sitecheck.svg", alt="SiteCheck")
  .max-w-md.mt-6.px-6.py-4.bg-white.shadow-md.overflow-hidden(
    class="sm:max-w-md sm:rounded-lg"
  )
    slot
</template>
