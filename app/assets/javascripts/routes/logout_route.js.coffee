Lionworxs.LogoutRoute = Ember.Route.extend
  beforeModel: ->
    @controllerFor('application').logOut()
