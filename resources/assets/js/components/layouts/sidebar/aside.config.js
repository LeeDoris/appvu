module.exports = [
    {name: 'Home', path: '/home', tree: false, class:'fa fa-home'},
    {name: 'Posts', path: '/posts', tree: false, class:'fa fa-files-o'},
    {name: 'Category', path: '/categories', tree: false, class:'fa fa-sitemap'},
    {name: 'Comment', path: '/comment', tree: true, child: [
      {name: 'Comment', path: '/comment'},
      {name: 'Reply', path: '/reply'}], class:'fa fa-comment'},
    {name: 'Admin', path: '/admin', tree: false, class:'fa fa-user'},
    {name: 'User', path: '/users', tree: false, class:'fa fa-user'}
]
// module.exports = [
//   {name: 'Home', path: '/', tree: false},
//   {name: 'Posts', path: '/posts', tree: true, child: [
//       {name: 'Index', path: '/posts'},
//       {name: 'Create', path: '/posts/:hashid/edit'},
//   ],class:'fa fa-files-o'
//   },
//   {name: 'Category', path: '/categories', tree: true, child: [
//       {name: 'Index', path: '/categories'},
//       {name: 'Create', path: '/categories/:hashid/edit'},
//   ],class:'fa fa-sitemap'
//   },
//   {name: 'Tag', path: '/tags', tree: true, child: [
//       {name: 'Index', path: '/posts'},
//       {name: 'Create', path: '/'},
//   ],class:'fa fa-tag'
//   },
//   {name: 'Comment', path: '/comments', tree: true, child: [
//       {name: 'Index', path: '/posts'},
//       {name: 'Create', path: '/'},
//   ],class:'fa fa-comment'
//   },
//   {name: 'Admin', path: '/admin', tree: true, child: [
//       {name: 'Index', path: '/admin'},
//       {name: 'Create', path: '/admin/create'},
//   ],class:'fa fa-user'
//   },
//   {name: 'User', path: '/users', tree: true, child: [
//       {name: 'Index', path: '/users'},
//       {name: 'Create', path: '/users/create'},
//   ],class:'fa fa-user'
//   }
// ]