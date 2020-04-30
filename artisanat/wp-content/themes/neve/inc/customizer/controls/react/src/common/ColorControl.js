/* global wp */
import PropTypes from 'prop-types'
import classnames from 'classnames'

const { ColorPicker, Button, Dropdown } = wp.components
const { Component, Fragment } = wp.element
const { __ } = wp.i18n

class ColorControl extends Component {
  render() {
    const { label, selectedColor } = this.props
    let toggle = null
    return (
      <div className='neve-control-header neve-color-component'>
        {
          label &&
            <span className='customize-control-title'>
              {label}
            </span>
        }

        <Dropdown
          renderToggle={( { isOpen, onToggle } ) => {
            toggle = onToggle
            return (
              <Button
                className={classnames(['is-secondary is-button', { 'is-empty': !selectedColor }])}
                onClick={onToggle}
                aria-expanded={isOpen}
                style={{ backgroundColor: selectedColor }}
              />
            )
          }}
          renderContent={() => (
            <Fragment>
              <ColorPicker
                color={selectedColor}
                onChangeComplete={( value ) => { this.props.onChange(value.hex) }}
                disableAlpha
              />
              {selectedColor &&
                <Button
                  className='clear'
                  isPrimary
                  onClick={() => {
                    this.props.onChange('')
                    toggle()
                  }}
                >
                  {__( 'Clear', 'neve' )}
                </Button>}
            </Fragment>
          )}
        />
      </div>
    )
  }
}

ColorControl.propTypes = {
  label: PropTypes.string,
  onChange: PropTypes.func.isRequired,
  selectedColor: PropTypes.string.isRequired
}

export default ColorControl
