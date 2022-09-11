import { Tag } from "view-ui-plus";
import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue"

export default function () {
  const sites = usePage().props.value.sites;

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
          return h("p", formatDate(row.last_check));
        },
      },
    ],
    data: sites,
  };

  return table
}
