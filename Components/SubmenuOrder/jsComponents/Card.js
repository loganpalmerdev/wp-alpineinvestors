import React from 'react'
import PropTypes from 'prop-types'

import TaxonomyCard from './TaxonomyCard'
import PostCard from './PostCard'

export default function Card ({
  data,
  type,
  slug,
  order
}) {
  return (
    <>
      { type === 'taxonomy' && <TaxonomyCard data={data} order={order} /> }
      { type === 'post' && <PostCard data={data} order={order} /> }
    </>
  )
}

Card.propTypes = {
  type: PropTypes.string.isRequired,
  slug: PropTypes.string.isRequired,
  data: PropTypes.object.isRequired,
  order: PropTypes.number.isRequired
}
