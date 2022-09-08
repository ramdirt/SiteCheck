<template lang="pug">
Head(title="Настройки")

BreezeAuthenticatedLayout
  .container.mt-4.flex.justify-center
    section
      Card.relative.mb-4.rounded-xl(class="w-[30rem]")
        h3.mb-2.text-lg.font-semibold Настройки пользователя

        Form(ref="addForm", :model="form", :rules="rules")
          FormItem(label="Ваше имя")
            Input(placeholder="Имя", v-model="form.name")
          FormItem(label="Почта для получения отчетов")
            Input(placeholder="Электронная почта", v-model="form.email")
          FormItem(label="ID Телеграм для получения отчетов")
            Input(placeholder="Электронная почта", v-model="form.telegram_id")
          FormItem(label="Интервал проверки")
            Select(v-model="form.interval")
              Option(
                v-for="item in intervalList",
                :value="item.value",
                :key="item.key",
                :selected="item.value === user.interval"
              ) {{ item.label }}
          FormItem(label="Каналы получения отчетов")
            Checkbox(v-model="form.report_email") Почта
            Checkbox(v-model="form.report_telegram") Телеграм

          .flex.justify-end
            Button(
              type="primary",
              @click="submit",
              :disabled="form.processing"
            ) Обновить
</template>

<script setup>
import { Message } from "view-ui-plus";
import { useForm, usePage } from "@inertiajs/inertia-vue3";

const user = usePage().props.value.auth.user;

const form = useForm({
  name: user.name,
  email: user.email,
  interval: user.interval,
  telegram_id: user.telegram_id,
  report_email: Boolean(user.report_email),
  report_telegram: Boolean(user.report_telegram),
});

const rules = {
  name: [{ required: true }],
  email: [{ required: true }],
};

const intervalList = [
  // TODO: Сделать получения параметров интервалов с бэка
  {
    value: 5,
    label: "5 Минут",
  },
  {
    value: 15,
    label: "15 Минут",
  },
];

const submit = () => {
  form.put(route("settings.update", { id: user.id }), {
    onSuccess: () => {
      Message.success("Настройки обновлены");
    },
    onError: (errors) => {
      if (errors.email) {
        return Message.error("Пользователь с такой почтой уже есть");
      }
      Message.error("Ошибка обновления настроек");
    },
  });
};
</script>