Lionworxs.ApplicationController = Ember.Controller.extend
  year: (->
      date = new Date()
      date.getFullYear()
  ).property()
