Lionworxs.UserSettings = DS.Model.extend
  grade: DS.attr('number')
  workload_variance: DS.hasMany('workloadVariance')
