<template lang='pug'>
Head(title="Сайты")

BreezeAuthenticatedLayout
  .container.mt-4(v-if='$parentSiteDetails')
    h2.text-semibold.text-lg.text-gray-700 {{$parentSiteDetails.name }}
    strong.text-gray-500 {{$parentSiteDetails.url }}

  .container.mt-4.lg__flex.lg__space-x-6
    section
      Card.relative.mb-4.rounded-xl(class="w-[30rem]")
        h3.mb-4.text-lg.font-semibold Добавить страницу

        Form(ref="addForm" :model="form" :rules="rules")
          FormItem(prop="name")
            Input(placeholder="Введите название страницы" v-model="form.name")
          FormItem(prop="url")
            Input(placeholder="page" v-model="form.url")

          .flex.justify-end
            Button(type="primary" @click="addPage('addForm')") Добавить

    section.w-full
      Card.relative.mb-4.rounded-xl
        h3.mb-4.text-lg.font-semibold Добавленные сайты

        .my-2
          Button(type='primary' ghost icon='md-refresh' @click='loadPages')

        Table(:columns="columns" :data="data" :loading="loading")
</template>

<script>
import axios from "axios";
import tableMixin from "./mixins/pagesTable";

export default {
  name: "PagesLayout",
  mixins: [tableMixin],

  data() {
    return {
      loading: false,
      data: [],

      form: {
        name: "",
        url: "",
      },
      rules: {
        name: [{ required: true }],
        url: [{ required: true }],
      },
    };
  },

  computed: {
    $parentSiteDetails() {
      return this.$attrs.$parentSiteDetails;
    }
  },

  created() {
    this.loadPages();
  },

  methods: {
    loadPages() {
      this.loading = true;

      const params = {
        // TODO Pagination, filtering, sorting
      };

      axios
        .get("/page", params)
        .then((response) => {
          if (response.status === 200) {
            this.data = response.data.data;
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },

    addPage() {
      const body = this.form;
      body.site_id = this.$parentSiteDetails.id;

      axios
        .post("/page/update", { body })
        .then(() => {
          this.loadSites();
        })
        .catch(() => {
          this.loading = false;
        });
    },
  },
};
</script>
