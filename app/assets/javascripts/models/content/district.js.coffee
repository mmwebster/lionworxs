Lionworxs.District = DS.Model.extend
  author: DS.belongsTo('user')
  name: DS.attr('string')
  description: DS.attr('string')
  administrators: DS.hasMany('user')
  schools: DS.hasMany('school')
