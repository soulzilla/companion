/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/galleries',
        name: 'Galleries',
        component: page('GalleryList'),
    },
    {
        path: '/galleries/:id',
        name: 'Show Gallery',
        component: page('GalleryView'),
        hidden: true
    }
]
