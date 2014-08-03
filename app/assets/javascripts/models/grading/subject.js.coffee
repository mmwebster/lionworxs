Lionworxs.Subject = DS.Model.extend
  author: DS.belongsTo('user')
  name: DS.attr('string')
  description: DS.attr('string')
  grading_system: DS.hasMany('gradingSystem')
