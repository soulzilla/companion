/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/admin/questions',
        name: 'Questions',
        component: page('QuestionList'),
    },
    {
        path: '/admin/questions/:id',
        name: 'Show Question',
        component: page('QuestionView'),
        hidden: true
    }
]
