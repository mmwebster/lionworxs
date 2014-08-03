Lionworxs.WorkloadVariance = DS.Model.extend
  author: DS.belongsTo('user')
  class: DS.hasMany('class')
  weight: DS.attr('number')
