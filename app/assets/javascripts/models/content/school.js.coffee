Lionworxs.School = DS.Model.extend
  author: DS.belongsTo('user')
  name: DS.attr('string')
  description: DS.attr('string')
  district: DS.belongsTo('district')
  classes: DS.hasMany('class')
  administrators: DS.hasMany('user')
  teachers: DS.hasMany('user')
  parents: DS.hasMany('user')
  students: DS.hasMany('user')
