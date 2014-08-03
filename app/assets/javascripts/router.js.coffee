# For more information see: http://emberjs.com/guides/routing/

Lionworxs.Router.map  ->
  @route 'about'
  @resource 'news'
  @route 'contact'
  @route 'register'
  @resource 'students', ->
    @route 'dashboard'
    @route 'classes'
    @route 'settings'
    @route 'help'
  @resource 'parents'
  @resource 'teachers'
  @resource 'administrators'
  @route 'login'
  @route 'logout'

# Resource routing
# @resource 'friends', ->
#   @resource 'friend', path: '/:friend_id', ->
