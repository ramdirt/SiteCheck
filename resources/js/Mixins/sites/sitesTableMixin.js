import { Button, Message, Modal } from "view-ui-plus";
import { usePage } from "@inertiajs/inertia-vue3";


export default function () {
  const sites = usePage().props.value.sites;

  const color_status = (status) => {
    if (status !== 1) {
      return "rgb(239 68 68)";
    } else {
      return "rgb(34 197 94)";
    }
  };
  const formatDate = (date) => new Date(date).toLocaleTimeString();

  const table = {
    columns: [
      {
        title: "Статус",
        width: 85,
        align: 'center',
        key: "status",
        render: (h, { row }) => {
          return h("div", {
            style: {
              background: color_status(row.status),
            },
            class: "ml-2 w-8 h-4 rounded-full border",
          });
        },
      },
      {
        title: "Название",
        key: "name",
      },
      {
        title: "Последняя проверка",
        key: "last_check",
        render: (h, { row }) => {
          return h("p", formatDate(row.last_check));
        },
      },
      {
        title: "Действия",
        key: "detail",
        render: (h, { row }) => {
          return h("div", {
            class: 'flex gap-2'
          }, [
            h(
              Button,
              {
                type: "error",
                icon: "md-trash",
                onClick: () => {
                  axios.delete(route('sites.destroy', { id: row.id }))
                  Message.success('Запись удалена, обновите страницу');
                }
              },
            ),
          ]);
        },
      },
    ],
    data: sites,
  };

  return table
}
