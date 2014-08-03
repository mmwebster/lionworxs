Lionworxs.GradingCategory = DS.Model.extend
  author: DS.belongsTo('user')
  name: DS.attr('string')
  description: DS.attr('string')
  weight: DS.attr('number')
