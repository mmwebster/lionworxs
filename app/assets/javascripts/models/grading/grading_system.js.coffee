Lionworxs.GradingSystem = DS.Model.extend
  author: DS.belongsTo('user')
  name: DS.attr('string')
  description: DS.attr('string')
  class: DS.belongsTo('class')
  subject: DS.hasMany('subject')
  grading_categories: DS.hasMany('gradingCategory')
