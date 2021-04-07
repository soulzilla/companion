/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/admin/interviews',
        name: 'Interviews',
        component: page('InterviewList'),
    },
    {
        path: '/admin/interviews/:id',
        name: 'Show Interview',
        component: page('InterviewView'),
        hidden: true
    }
]
