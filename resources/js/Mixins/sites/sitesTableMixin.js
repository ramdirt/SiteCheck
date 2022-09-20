import { Tag } from "view-ui-plus";
import GlobalMixin from "@/Mixins/GlobalMixin";
import { reactive, onMounted } from "vue"

export default function () {
  const { user, token, sites } = GlobalMixin();

  const state = reactive({
    sites: [],
    loading: true
  });

  onMounted(() => {
    axios.get('/api/sites', { headers: { "Authorization": `Bearer ${token}` } })
      .then((response) => {
        state.sites = response.data;
        state.loading = false;
      })
      .catch((error) => {
      })
  })


  const color_status = (status) => {
    return status !== 1 ? 'error' : 'success';
  };

  const text_status = (status) => {
    return status !== 1 ? 'ERR' : 'OK';
  };

  const formatDate = (date) => new Date(date).toLocaleTimeString();

  const table = {
    columns: [
      {
        title: 'Статус',
        width: 85,
        align: 'center',
        key: 'status',
        render: (h, { row }) => {
          return h(Tag, {
            color: color_status(row.status)
          }, () => text_status(row.status))
        }
      },
      {
        title: "Ресурсы",
        key: "name",
        render: (h, { row }) => {
          return h('p', row.name);
        }
      },
      {
        title: "Последняя проверка",
        key: "last_check",
        render: (h, { row }) => {
          return h("p", formatDate(user.last_check));
        },
      },
    ],
    data: sites,
    loading: state.loading
  };

  return { table, state };
}
