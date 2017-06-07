import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AltaReservaComponent } from './alta-reserva.component';

describe('AltaReservaComponent', () => {
  let component: AltaReservaComponent;
  let fixture: ComponentFixture<AltaReservaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AltaReservaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AltaReservaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
