import {
    BreezeButton,
    BreezeCheckbox,
    BreezeDropdown,
    BreezeDropdownLink,
    BreezeInput,
    BreezeInputError,
    BreezeLabel,
    BreezeNavLink,
    BreezeResponsiveNavLink,
    BreezeValidationErrors
} from './Components';

import {
    BreezeAuthenticatedLayout,
    BreezeGuestLayout
} from './Layouts';

export default {
    install(Vue) {
        Vue.component('BreezeButton', BreezeButton);
        Vue.component('BreezeCheckbox', BreezeCheckbox);
        Vue.component('BreezeDropdown', BreezeDropdown);
        Vue.component('BreezeDropdownLink', BreezeDropdownLink);
        Vue.component('BreezeInput', BreezeInput);
        Vue.component('BreezeInputError', BreezeInputError);
        Vue.component('BreezeLabel', BreezeLabel);
        Vue.component('BreezeNavLink', BreezeNavLink);
        Vue.component('BreezeResponsiveNavLink', BreezeResponsiveNavLink);
        Vue.component('BreezeValidationErrors', BreezeValidationErrors);

        Vue.component('BreezeAuthenticatedLayout', BreezeAuthenticatedLayout);
        Vue.component('BreezeGuestLayout', BreezeGuestLayout);
    }
};
