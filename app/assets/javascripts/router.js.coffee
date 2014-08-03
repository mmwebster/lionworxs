# For more information see: http://emberjs.com/guides/routing/

Lionworxs.Router.map  ->
  @route 'about'
  @resource 'news'
  @route 'contact'
  @route 'login'
  @route 'register'
  @resource 'students', ->
    @route 'dashboard'
  @resource 'parents'
  @resource 'teachers'
  @resource 'administrators'

# Resource routing
# @resource 'friends', ->
#   @resource 'friend', path: '/:friend_id', ->
