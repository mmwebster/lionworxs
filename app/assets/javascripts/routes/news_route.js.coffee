Lionworxs.NewsRoute = Ember.Route.extend
  model: ->
    return @store.find 'newsItem'

  setupController: (controller, model)->
    controller.set 'model', model
