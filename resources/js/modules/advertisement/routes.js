/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/admin/advertisements',
        name: 'Advertisements',
        component: page('AdvertisementList'),
    },
    {
        path: '/admin/advertisements/:id',
        name: 'Show Advertisement',
        component: page('AdvertisementView'),
        hidden: true
    }
]
