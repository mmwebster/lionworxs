Lionworxs.ApplicationController = Ember.Controller.extend
  year: (->
      date = new Date()
      date.getFullYear()
  ).property()

  loggedIn: false
  userType: false

  logIn: (user_type)->
    @set('loggedIn', true)
    @set('userType', user_type)
    @transitionTo(user_type + '.dashboard')
  logOut: ->
    @set('loggedIn', false)
    @set('userType', false)
    @transitionTo('index')
